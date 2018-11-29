/*queries
#CONSIDERACOES
#- VERIFICAR DATAS
#- VER SE OS NOMES DAS VARIAVEIS ESTAO CONFORME O NOME DAS COLUNAS CRIADAS
*/
--1. qual o processo de socorro que envolveu maior numero de meios distintos?

select numProcessoSocorro from (
		select numProcessoSocorro, count((numMeio,nomeEntidade))
			from acciona
			group by numProcessoSocorro
	) as a
	inner join (
		select  max(count) from (
			select numProcessoSocorro, count((numMeio,nomeEntidade))
				from acciona
				group by numProcessoSocorro
			) as aux
		) as b
		ON b.max = a.count;




--2. Qual a entidade fornecedora de meios que participou em mais processos de socorro no Verão de 2018

select nomeEntidade from (
	select nomeEntidade,  count(nomeEntidade)
		from acciona natural join (
			select * from eventoEmergencia
				where instanteChamada >= '2018.06.01 00:00:00'
					and instanteChamada < '2018.09.01 00:00:00' ) as t
		group by nomeEntidade) as a
	inner join (
		select max(count) from (
			select nomeEntidade,  count(nomeEntidade)
				from acciona natural join (
					select * from eventoEmergencia
						where instanteChamada >= '2018.06.01 00:00:00'
							and instanteChamada < '2018.09.01 00:00:00' ) as b
				group by nomeEntidade

	) as c
)  as d
 ON d.max = a.count ;

--3. Quais são os processos de socorro, referente a eventos de emergência
--   em 2018 de Oliveira do Hospital, onde existe pelo menos um acionamento
--	de meios que não foi alvo de auditoria;

select distinct numProcessoSocorro from (
	select numProcessoSocorro,numMeio,nomeEntidade from
		acciona natural join eventoEmergencia
			where instanteChamada >= '2018.01.01 00:00:00'
				and instanteChamada < '2019.01.01 00:00:00'
				and moradaLocal = 'Oliveira do Hospital'
		except
		select numProcessoSocorro,numMeio,nomeEntidade from
			audita natural join eventoEmergencia
			where instanteChamada >= '2018.01.01 00:00:00'
				and instanteChamada < '2019.01.01 00:00:00'
				and moradaLocal = 'Oliveira do Hospital'
)as w;

--4. Quantos segmentos de vídeo com duração superior a 60 segundos,
--   foram gravados em câmeras de vigilância de Monchique durante o mês de Agosto de 2018;

select count((numSegmento,numCamara))
	from vigia natural join video natural join segmentoVideo
		where duracao > '00:01:00'
			and dataHoraInicio >= '2018.08.01 00:00:00'
			and dataHoraFim < '2018.09.01 00:00:00'
			and moradaLocal = 'Monchique';

--5. Liste os Meios de combate que não foram usados como Meios de
--	Apoio em nenhum  processo de socorro;

	select numMeio, nomeEntidade from
		meioCombate natural join acciona
		except
		select numMeio,nomeEntidade from
			meioApoio natural join acciona;

--6. Liste as entidades que forneceram meios de combate a todos os
--	Processos de socorro que acionaram meios;


select distinct nomeEntidade
from acciona d
where not exists (
	select numProcessoSocorro
	from acciona
	except
	select numProcessoSocorro
	from (acciona natural join meioCombate) as b

	where b.nomeEntidade = d.nomeEntidade
);
