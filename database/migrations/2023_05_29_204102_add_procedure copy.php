<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        drop  procedure if exists  proc_ByDays;
        create procedure proc_ByDays(
            IN idQualification int,
            IN dateStart varchar(255),
            IN filterBy varchar(255))
        BEGIN
            DECLARE start_date varchar(100);
            DECLARE finish_date timestamp;
            DECLARE join_format varchar(100);
            DECLARE show_format varchar(100);
            -- check if start date not empty and if empty default = current date
            IF
                    dateStart = ''
            THEN
                SET dateStart = date(now());
            else
                SET dateStart = date(dateStart);
            END IF;
        
        
            -- check if filter by variable not empty and if is empty fill it by default = Day
            IF
                    filterBy = ''
            THEN
                SET filterBy = 'DAY';
            END IF;
        
            -- for now we have only day and moneth so if else is a good option
            IF
                    filterBy = 'DAY'
            THEN
                SET start_date = CONCAT_WS(' ', DATE(dateStart), '00:00:00');
                SET finish_date = date_add(start_date, INTERVAL 11 DAY );
                SET join_format = '%b %d';
                SET show_format = '%b %d';
                SET filterBy = 'DAY';
            END IF;
        
            IF
                    filterBy = 'DECADES'
            THEN
                SET start_date = CONCAT_WS(' ', DATE(dateStart), '00:00:00');
                SET finish_date = date_add(start_date, INTERVAL 9 DAY);
                SET join_format = '%b %d';
                SET show_format = '%b %d';
                SET filterBy = 'DAY';
            END IF;
            IF
                    filterBy = 'MONTH'
            THEN
                SET start_date = CONCAT_WS(' ', DATE(dateStart), '00:00:00');
                SET finish_date = date_add(start_date, INTERVAL 11 month );
                SET join_format = '%Y %b';
                SET show_format = '%Y %b';
                SET filterBy = 'month';
            END IF;
        
            select date_format(m.type, show_format) as 'time',
                   round(avg(b.mesure), 2)          as 'mesure'
            from mesure_quantification b
                     left join qualifications c on b.mesure = c.idQT
        
                     right join
                 (select m1 as 'type'
                  from (select start_date + INTERVAL m DAY as m1
                        from (select @rownum := @rownum + 1 as m
                              from (select 1 union select 2 union select 3 union select 4) t1,
                                   (select 1 union select 2 union select 3 union select 4) t2,
                                   (select 1 union select 2 union select 3 union select 4) t3,
                                   (select 1 union select 2 union select 3 union select 4) t4,
                                   (select @rownum := -1) t0) d1) d2
                  where m1 <= finish_date
                  order by m1)
                     AS m on date_format(m.type, join_format) = date_format(b.date, join_format)
                     and b.date between start_date and finish_date
                    and c.idQT = idQualification
        
        
            group by date_format(m.type, show_format);
        
        END;

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::unprepared('drop  procedure if exists  proc_ByDays;');

    }
};
