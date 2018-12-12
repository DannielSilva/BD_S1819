DROP TABLE IF EXISTS d_evento;
DROP TABLE IF EXISTS d_meio;
DROP TABLE IF EXISTS d_tempo;

CREATE TABLE d_evento (
    idEvento integer not null,
    numTelefone numeric(16) not null,
    instanteChamada timestamp not null
    -- primary key?
);

CREATE TABLE d_meio (
    idMeio integer not null,
    numMeio numeric(16) not null,
    nomeMeio varchar(80) not null,
    nomeEntidade varchar(80) not null,
    tipo varchar(20) not null
);

CREATE TABLE d_tempo (
  idTempo integer not null,
  dia integer not null,
  mes integer not null,
  ano integer not null
);

CREATE TABLE factos(
  idMeio integer not null,
  idEvento integer not null,
  idTempo integer not null
);

CREATE SEQUENCE serial START 1;
INSERT INTO d_evento (idEvento, numTelefone, instanteChamada)
  SELECT nextval('serial'), numTelefone, instanteChamada
  FROM eventoEmergencia;

CREATE SEQUENCE serial START 1;
--insere os meios de apoio
INSERT INTO d_meio (idMeio, numMeio, nomeMeio, nomeEntidade, tipo)
  SELECT nextval('serial'),numMeio, nomeMeio, nomeEntidade, 'Apoio'
  FROM Meio a
  WHERE EXISTS (
    SELECT 1 FROM meioApoio
      WHERE numMeio = a.numMeio and nomeEntidade = a.nomeEntidade)



INSERT INTO d_tempo (idTempo, dia, mes, ano) 
  SELECT to_char(generate_series ,'YYYYMMDD')::int, 
    EXTRACT(DAY FROM generate_series ),
    EXTRACT(MONTH FROM generate_series),
    EXTRACT(YEAR FROM generate_series)
    FROM generate_series('2017-01-01'::date,'2018-09-10', '1 day');

INSERT INTO factos(idMeio, idEvento, idTempo)
  SELECT DISTINCT idMeio, idEvento, idTempo
  FROM (
      d_evento inner join d_tempo on d_evento.instanteChamada::DATE = TO_TIMESTAMP(d_tempo.idTempo, 'YYYYMMDD')::DATE
      natural join eventoEmergencia natural join acciona natural join d_meio
    );

