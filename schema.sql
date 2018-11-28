drop table camara cascade;
drop table video cascade;
drop table segmentoVideo cascade;
drop table account cascade;
drop table customer cascade;
drop table branch cascade;




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
    numCamara numeric(16) not null unique,
    constraint pk_video primary key(dataHoraInicio),
    constraint fk_camara foreign key(numCamara) references camara(numCamara)
);

create table segmentoVideo (
    numSegmento numeric(16) not null,
    duracao time not null,
    numCamara numeric(16) not null unique,
    dataHoraInicio timestamp not null,
    constraint pk_segmentoVideo primary key(numSegmento),
    constraint fk_video foreign key(numCamara) references video(numCamara),
    constraint fk_video foreign key(dataHoraInicio) references video(dataHoraInicio)
);
 --not in natural habitat
create table local (
    moradaLocal varchar(31) not null,
    constraint pk_local primary key(moradaLocal) 
);

create table vigia (
    moradaLocal varchar(31) not null,
    numCamara numeric(16) not null,
    constraint fk_local foreign key(moradaLocal) references local(moradaLocal),
    constraint fk_camara foreign key(numCamara) references camara(numCamara)
);

create table eventoEmergencia (
    numTelefone numeric(16) not null,
    instanteChamada timestamp not null,
    nomePessoa varchar(31) not null,
    moradaLocal varchar(31) not null,
    numProcessoSocorro numeric(16),
    unique (numTelefone, nomePessoa),
    constraint pk_eventoEmergencia primary key(numTelefone, instanteChamada),
    constraint fk_local foreign key(moradaLocal) references local(moradaLocal),
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro)
);

create table processoSocorro (
    numProcessoSocorro numeric(16) not null unique,
    constraint pk_processoSocorro primary key(numProcessoSocorro)
);

create table entidadeMeio (
    nomeEntidade varchar(31) not null unique,
    constraint pk_entidadeMeio primary key(nomeEntidade)
);

create table meio (
    numMeio numeric(16) not null,
    nomeMeio varchar(31) not null,
    nomeEntidade varchar(31) not null,
    constraint pk_meio primary key(numMeio),
    constraint fk_entidadeMeio foreign key(nomeEntidade) references entidadeMeio(nomeEntidade)
);

create table meioCombate (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    constraint fk_meio foreign key(numMeio) references meio(numMeio),
    constraint fk_meio foreign key(nomeEntidade) references meio(nomeEntidade)
);

create table meioApoio (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    constraint fk_meio foreign key(numMeio) references meio(numMeio),
    constraint fk_meio foreign key(nomeEntidade) references meio(nomeEntidade)
);

create table meioSocorro (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    constraint fk_meio foreign key(numMeio) references meio(numMeio),
    constraint fk_meio foreign key(nomeEntidade) references meio(nomeEntidade)
);
  
create table transporta (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    numVitimas SMALLINT not null,
    numProcessoSocorro numeric(16) not null,
    constraint fk_meioSocorro foreign key(numMeio) references meioSocorro(numMeio),
    constraint fk_meioSocorro foreign key(nomeEntidade) references meioSocorro(nomeEntidade),
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro)
);
  
create table alocado (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    numHoras SMALLINT not null,
    numProcessoSocorro numeric(16) not null,
    constraint fk_meioApoio foreign key(numMeio) references meioApoio(numMeio),
    constraint fk_meioApoio foreign key(nomeEntidade) references meioApoio(nomeEntidade),
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro)
);
  
create table acciona (
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    numProcessoSocorro numeric(16) not null,
    constraint fk_meio foreign key(numMeio) references meio(numMeio),
    constraint fk_meio foreign key(nomeEntidade) references meio(nomeEntidade),
    constraint fk_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro)
);
  
create table coordenador (
    idCoordenador numeric(16) not null unique,
    constraint pk_coordenador primary key(idCoordenador)
);

create table audita (
    idCoordenador numeric(16) not null,
    numMeio numeric(16) not null,
    nomeEntidade varchar(31) not null,
    numProcessoSocorro numeric(16) not null,
    dataHoraInicio time not null CHECK (dataHoraInicio < dataHoraFim),
    dataHoraFim time not null CHECK (dataHoraInicio < dataHoraFim),
    dataAuditoria date not null CHECK (dataAuditoria > CURDATE()),
    texto varchar(8000) not null,
    constraint fk_coordenador foreign key(idCoordenador) references coordenador(idCoordenador),
    constraint fk_acciona foreign key(numMeio) references acciona(numMeio),
    constraint fk_acciona foreign key(nomeEntidade) references acciona(nomeEntidade),
    constraint fk_acciona foreign key(numProcessoSocorro) references acciona(numProcessoSocorro),
);

create table solicita (
    idCoordenador numeric(16) not null,
    numCamara numeric(16) not null,
    dataHoraInicioVideo timestamp not null,
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null CHECK (dataHoraInicio < dataHoraFim),
    constraint fk_coordenador foreign key(idCoordenador) references coordenador(idCoordenador),
    constraint fk_video foreign key(numCamara) references video(numCamara),
    constraint fk_video foreign key(dataHoraInicioVideo) references video(dataHoraInicio)
);


create table depositor
   (customer_name 	varchar(80)	not null,
    account_number 	char(5)	not null,
    constraint pk_depositor primary key(customer_name, account_number),
    constraint fk_depositor_customer foreign key(customer_name) references customer(customer_name),
    constraint fk_depositor_account foreign key(account_number) references account(account_number));

create table loan
   (loan_number 	char(5)	not null unique,
    branch_name		varchar(80) not null,
    amount 		numeric(16,4) not null,
    constraint pk_loan primary key(loan_number),
    constraint fk_loan_branch foreign key(branch_name) references branch(branch_name));

create table borrower
   (customer_name 	varchar(80) not null,
    loan_number 	char(5)	not null,
    constraint pk_borrower primary key(customer_name, loan_number),
    constraint fk_borrower_customer foreign key(customer_name) references customer(customer_name),
    constraint fk_borrower_loan foreign key(loan_number) references loan(loan_number));

----------------------------------------
-- Populate Relations 
----------------------------------------
