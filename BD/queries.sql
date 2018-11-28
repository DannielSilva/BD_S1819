/*queries
#CONSIDERACOES
#- VERIFICAR DATAS
#- VER SE OS NOMES DAS VARIAVEIS ESTAO CONFORME O NOME DAS COLUNAS CRIADAS
*/
--1. qual o processo de socorro que envolveu maior numero de meios distintos?

select numProcessoSocorro from ( 
	select max(count) from (
		select numProcessoSocorro, count(numMeio,nomeEntidade)
		from acciona 
		)
	
	natural join (select count(numProcessoSocorro,numMeio,nomeEntidade) 
		from acciona )
);

--2. Qual a entidade fornecedora de meios que participou em mais processos de socorro no Verão de 2018

select nomeEntidade from (
	select max(count) from (
		select count(nomeEntidade) 
		from acciona 
		where instanteChamada >= '2018.06.01 00:00:00' 
				and instanteChamada <= '2018.09.01 00:00:00'
	)
);

--3. Quais são os processos de socorro, referente a eventos de emergência
--   em 2018 de Oliveira do Hospital, onde existe pelo menos um acionamento 
--	de meios que não foi alvo de auditoria; 

select numProcessoSocorro from (
	acciona natural join (
		select * from (
			local natural join origina
		)
		where instanteChamada >= '2018.01.01 00:00:00' 
				and instanteChamada <= '2019.09.01 00:00:00'
	)
	
	right join (
		select * from audita natual join (
			select * from (
				local natural join origina
		)
			where instanteChamada >= '2018.01.01 00:00:00' 
					and instanteChamada <= '2019.09.01 00:00:00'
) ;

--4. Quantos segmentos de vídeo com duração superior a 60 segundos, 
--   foram gravados em câmeras de vigilância de Monchique durante o mês de Agosto de 2018;

select count(segmentoVideo) 
from vigia natural join video
where duracao > '00:01:00' 
and dataHoraInicio >= '01:08:2018 00:00:00'
and dataHoraFim <= '01:09:2018 00:00:00'
and moradaLocal = 'Monchique';

--5. Liste os Meios de combate que não foram usados como Meios de 
--	Apoio em nenhum  processo de socorro; 

select * from (
	select nomeEntidade, numProcessoSocorro from(
		meioApoio natural join acciona)
	left join ( 
		select numMeio,nomeEntidade from(
			meioCombate natural join acciona) )
);

--6. Liste as entidades que forneceram meios de combate a todos os 
--	Processos de socorro que acionaram meios;


select nomeEntidade
from acciona d
where not exists (
	select numProcessoSocorro
	from acciona 
	except
	select numProcessoSocorro
	from (acciona inner join meioCombate) b
	where b.numProcessoSocorro = d.numProcessoSocorro
)