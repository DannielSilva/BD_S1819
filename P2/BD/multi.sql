DROP TABLE IF EXISTS d_evento;
DROP TABLE IF EXISTS d_meio;
DROP TABLE IF EXISTS d_tempo;

CREATE TABLE d_evento (
    idEvento integer not null,
    numTelefone numeric(16) not null,
    instanteChamada timestamp not null
);

CREATE TABLE d_meio (
    idMeio integer not null,
    numMeio numeric(16) not null,
    nomeMeio varchar(80) not null,
    nomeEntidade varchar(80) not null,
    tipo varchar(20) not null
);

CREATE TABLE d_tempo (
  dia integer not null,
  mes integer not null,
  ano integer not null
);

CREATE SEQUENCE serial START 1;
INSERT INTO d_evento (idEvento, numTelefone, instanteChamada)
  SELECT nextval('serial'), numTelefone, instanteChamada
  FROM eventoEmergencia;

CREATE SEQUENCE serial START 1;
INSERT INTO d_meio (idMeio, numMeio, nomeMeio, nomeEntidade, tipo)
  SELECT nextval('serial'),numMeio, nomeMeio, nomeEntidade, 'Apoio'
  FROM Meio a
  WHERE EXISTS (
    SELECT 1 FROM meioApoio
    WHERE numMeio = a.numMeio and nomeMeio = a.nomeMeio and nomeEntidade = a.nomeEntidade
  );


  --SELECT nextval('serial')

