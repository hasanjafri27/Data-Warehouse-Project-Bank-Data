use DWbank

bulk insert Dwbank.banksys.district
from 'C:\Users\Faizan\Desktop\districtfinal.csv'
with 
(
rowterminator='\n',
fieldterminator=','
)


