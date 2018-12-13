
select tipo, ano, mes, COUNT(idMeio) 
from factos natural join d_tempo natural join d_meio
where idEvento = 15
group by tipo, ano, mes

union

select tipo, ano, null, COUNT(idMeio) 
from factos natural join d_tempo natural join d_meio
where idEvento = 15
group by tipo, ano

union

select tipo, null, null, COUNT(idMeio) 
from factos natural join d_tempo natural join d_meio
where idEvento = 15
group by tipo

union

select null, null, null, COUNT(idMeio) 
from factos natural join d_tempo natural join d_meio
where idEvento = 15
order by tipo;