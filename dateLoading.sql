use banksystem

bulk insert Dwbank.banksys.day_dimension
from 'C:\Users\Faizan\Desktop\datefinal.csv'
with 
(
rowterminator='\n',
fieldterminator=','
)