use DWbank

bulk insert Dwbank.banksys.account_dimension
from 'C:\Users\Faizan\Desktop\accountFinal.csv'
with 
(
rowterminator='\n',
fieldterminator=','
)