--1
drop index  if exists morada_idx;
drop index  if exists numCamara1_idx;
drop index  if exists numCamara2_idx;
create index morada_idx on vigia using hash (moradaLocal);
create index numCamara1_idx on vigia using hash (numCamara);
create index numCamara2_idx on video using hash (numCamara);

--2
