drop table usuarios cascade;

create table usuarios (
  id        bigserial    constraint pk_usuarios primary key,
  email     varchar(200) constraint uq_usuarios_email unique,
  password  char(32)     not null,
  nombre    varchar(100),
  apellidos varchar(200)
);

insert into usuarios (email, password, nombre, apellidos)
values ('ricpelo@gmail.com', md5('hola'), 'Ricardo', 'Pérez');
insert into usuarios (email, password, nombre, apellidos)
values ('richard@stallman.org', md5('adios'), 'Richard', 'Stallman');


drop table envios cascade;

create table envios (
  id             bigserial constraint pk_envios primary key,
  id_propietario bigint    constraint fk_envios_propietario references usuarios (id)
                           on delete cascade on update cascade,
  id_receptor    bigint    constraint fk_envios_receptor    references usuarios (id)
                           on delete cascade on update cascade,
  fechahora      timestamptz,
  texto          text
);

insert into envios (id_propietario, id_receptor, fechahora, texto)
values (1, 1, current_timestamp, 'hola caracola');
insert into envios (id_propietario, id_receptor, fechahora, texto)
values (2, 1, current_timestamp, 'adiós blancaflor');


drop table solicitudes cascade;

create table solicitudes (
  id_solicitante bigint constraint fk_solicitudes_solicitante references usuarios (id)
                        on delete cascade on update cascade,
  id_solicitado  bigint constraint fk_solicitudes_solicitado  references usuarios (id)
                        on delete cascade on update cascade,
  constraint ck_usuarios_distintos check (id_solicitante != id_solicitado),
  constraint pk_solicitudes primary key (id_solicitante, id_solicitado)
);

drop table contactos cascade;

create table contactos (
  id_amigo1 bigint constraint fk_solicitudes_amigo1 references usuarios (id)
                   on delete cascade on update cascade,
  id_amigo2 bigint constraint fk_solicitudes_amigo2 references usuarios (id)
                   on delete cascade on update cascade,
  constraint pk_contactos primary key (id_amigo1, id_amigo2),
  constraint ck_contactos_validos check (id_amigo1 < id_amigo2)
);


