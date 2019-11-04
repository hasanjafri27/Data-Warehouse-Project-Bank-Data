use DWbank

bulk insert Dwbank.banksys.trans_fact
from 'C:\Users\Faizan\Desktop\factfinal.csv'
with 
(
rowterminator='\n',
fieldterminator=','
)


