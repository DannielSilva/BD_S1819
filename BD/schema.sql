
 
drop TABLE if EXISTS vigia cascade ;
drop TABLE if EXISTS audita cascade;
drop TABLE if EXISTS solicita cascade;
drop TABLE if EXISTS acciona cascade;
drop TABLE if EXISTS transporta  cascade;
drop TABLE if EXISTS alocado cascade;
drop TABLE if EXISTS meioCombate cascade;
drop TABLE if EXISTS meioApoio cascade;
drop TABLE if EXISTS meioSocorro cascade;
drop TABLE if EXISTS meio cascade;
drop TABLE if EXISTS entidadeMeio cascade;
drop TABLE if EXISTS eventoEmergencia cascade;
drop TABLE if EXISTS processoSocorro  cascade;
drop TABLE if EXISTS segmentoVideo  cascade;
drop TABLE if EXISTS video  cascade;
drop TABLE if EXISTS camara  cascade;
drop TABLE if EXISTS local cascade;
drop TABLE if EXISTS coordenador cascade;



----------------------------------------
-- Table Creation
----------------------------------------

-- Named constraints are global to the database.
-- Therefore the following use the following naming rules:
--   1. pk_table for names of primary key constraints
--   2. fk_table_another for names of foreign key constraints

create table camara (
    numCamara numeric(16) not null unique,
    constraint pk_camara primary key(numCamara)
);

create table video (
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null,
    numCamara numeric(16) not null,
    constraint pk_video primary key(dataHoraInicio, numCamara),
    constraint fk_camara foreign key(numCamara) references camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);

create table segmentoVideo (
    numSegmento numeric(16) not null,
    duracao time not null,
    numCamara numeric(16) not null ,
    dataHoraInicio timestamp not null,
    constraint pk_segmentoVideo primary key(numSegmento, dataHoraInicio, numCamara),
    constraint fk_video foreign key(numCamara,dataHoraInicio) references video(numCamara,dataHoraInicio) ON DELETE CASCADE ON UPDATE CASCADE
);
 --not in natural habitat
create table local (
    moradaLocal varchar(80) not null,
    constraint pk_local primary key(moradaLocal) 
);

create table processoSocorro (
    numProcessoSocorro numeric(16) not null unique,
    constraint pk_processoSocorro primary key(numProcessoSocorro)
    --RI: todo o processo de socorro está associado a um ou mais EventoEmergencia
);

create table eventoEmergencia (
    numTelefone numeric(16) not null,
    instanteChamada timestamp not null,
    nomePessoa varchar(80) not null,
    moradaLocal varchar(80) not null,
    numProcessoSocorro numeric(16),
    unique (numTelefone, nomePessoa),
    constraint pk_eventoEmergencia primary key(numTelefone, instanteChamada),
    constraint fk_local foreign key(moradaLocal) references local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);


create table entidadeMeio (
    nomeEntidade varchar(80) not null unique,
    constraint pk_entidadeMeio primary key(nomeEntidade)
);

create table meio (
    numMeio numeric(16) not null,
    nomeMeio varchar(80) not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meio primary key(numMeio, nomeEntidade),
    constraint fk_entidadeMeio foreign key(nomeEntidade) references entidadeMeio(nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table meioCombate (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meio_c primary key(numMeio, nomeEntidade),
    constraint fk_meio foreign key(numMeio,nomeEntidade) references meio(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table meioApoio (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meio_a primary key(numMeio, nomeEntidade),
    constraint fk_meio foreign key(numMeio,nomeEntidade) references meio(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table meioSocorro (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meio_s primary key(numMeio, nomeEntidade),
    constraint fk_meio foreign key(numMeio,nomeEntidade) references meio(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table transporta (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    numVitimas SMALLINT not null,
    numProcessoSocorro numeric(16) not null,
    constraint pk_transporta primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_meioSocorro foreign key(numMeio,nomeEntidade) references meioSocorro(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);
  
create table alocado (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    numHoras SMALLINT not null,
    numProcessoSocorro numeric(16) not null,
    constraint pk_alocado primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_meioApoio foreign key(numMeio,nomeEntidade) references meioApoio(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);
  
create table acciona (
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    numProcessoSocorro numeric(16) not null,
    constraint pk_acciona primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_meio foreign key(numMeio,nomeEntidade) references meio(numMeio,nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);
  
create table coordenador (
    idCoordenador numeric(16) not null unique,
    constraint pk_coordenador primary key(idCoordenador) 
);


create table vigia (
    moradaLocal varchar(80) not null,
    numCamara numeric(16) not null,
    constraint pk_vigia primary key(moradaLocal, numCamara),
    constraint fk_local foreign key(moradaLocal) references local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_camara foreign key(numCamara) references camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);

create table audita (
    idCoordenador numeric(16) not null,
    numMeio numeric(16) not null,
    nomeEntidade varchar(80) not null,
    numProcessoSocorro numeric(16) not null,
    dataHoraInicio time not null CHECK (dataHoraInicio < dataHoraFim),
    dataHoraFim time not null CHECK (dataHoraInicio < dataHoraFim),
    dataAuditoria date not null CHECK (dataAuditoria <= now()),
    texto varchar(8000) not null,
    constraint pk_audita primary key(idCoordenador, numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_coordenador foreign key(idCoordenador) references coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_acciona foreign key(numMeio, nomeEntidade, numProcessoSocorro) references acciona(numMeio, nomeEntidade, numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);

create table solicita (
    idCoordenador numeric(16) not null,
    numCamara numeric(16) not null,
    dataHoraInicioVideo timestamp not null,
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null CHECK (dataHoraInicio < dataHoraFim),
    constraint pk_solicita primary key(idCoordenador, dataHoraInicioVideo, numCamara),
    constraint fk_coordenador foreign key(idCoordenador) references coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_video foreign key(numCamara,dataHoraInicioVideo) references video(numCamara,dataHoraInicio) ON DELETE CASCADE ON UPDATE CASCADE
);


----------------------------------------
-- Populate Relations 
----------------------------------------
