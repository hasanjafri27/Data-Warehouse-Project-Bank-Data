use banksystem
select distinct
bank.transaction1.trans_id AS dayID,


CAST(DATEPART(DAY,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(2)) as Day,
CAST(DATEPART(MONTH,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(2)) as Month,
CAST(DATEPART(YEAR,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(4)) as Year /*+ ' ' +*/ 

from banksystem.bank.transaction1

/*count ( select ROW_NUMBER() OVER (ORDER BY (banksystem.bank.transaction1.date1)) from banksystem.bank.transaction1.date1),
*/

/*convert (date, convert(char(10), bank.transaction1.date1)),
convert (date, convert(char(10), bank.account.date1)),
CAST(DATEPART(YEAR,bank.transaction1.date1) AS VARCHAR(4)), /*+ ' ' +*/ 
CAST(DATEPART(MONTH,bank.transaction1.date1) AS VARCHAR(2))*/

/*ROW_NUMBER() OVER (ORDER BY (bank.transaction1.date1)) AS ROWnumber,*/
/*(
select @abc 
if @a< count(banksystem.bank.transaction1.date1)

) AS date_id,*/

/*group by bank.transaction1.date1
having count(*) > 1
order by bank.transaction1.date1*/

/*convert(datetime, convert(char(8), date_as_int)) as date_as_type
   , dateadd(second, time_as_int, convert(datetime, convert(char(8), date_as_int))) as datetime_added_seconds
   , dateadd(minute, time_as_int, convert(datetime, convert(char(8), date_as_int))) as datetime_added_minutes
from #test*/