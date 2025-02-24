/*
create table veiculo_categoria(
id_categoria int(11) AUTO_INCREMENT not null, 
descricao varchar(50), 
ativo char(1) default null, 
data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_categoria`)
)

create table cadfuncionario(
idfuncionario int(11) AUTO_INCREMENT not null, 
nome varchar(200) not null,
salario varchar(10),
usuario varchar(15) not null,
senha varchar(15) not null,
dtnascimento datetime,
data datetime not null default current_timestamp(),
ativo char(1) default 'S', 
PRIMARY KEY (`idfuncionario`)
)
*/

create table aeroporto(id_aeroporto int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_aeroporto`));

create table hotel(id_hotel int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_hotel`));

create table origem(id_origem int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_origem`));

create table tiposervico(id_tiposervico int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_tiposervico`));

create table operador(id_operador int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_operador`));

create table usuario(id_usuario int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_usuario`));

create table tipovenda(id_tipovenda int(11) AUTO_INCREMENT not null, descricao varchar(100),data datetime NOT NULL default current_timestamp(), 
PRIMARY KEY (`id_tipovenda`));

create table cadreserva(id_reserva int(11) AUTO_INCREMENT not null, 
nome_passageiro varchar(100),
data datetime NOT NULL default current_timestamp(), 
dt_lancamento date not null default current_timestamp(),
hr_lancamento time not null default current_timestamp(),
id_usuario int(11) references usuario(id_usuario),
id_tipovenda int(11) references tipovenda(id_tipovenda),
telefone varchar(15),
email varchar(100),
qtde_pessoas int(11),
qtde_adt int(11),
qtde_chd int(11),
qtde_free int(11),
id_operador int(11) references operador(id_operador),
id_origem int(11) references origem(id_origem),
valor_total numeric(18, 2),
observacao varchar(350),
PRIMARY KEY (`id_reserva`));

create table cadservico(id_servico int(11) AUTO_INCREMENT not null, 
id_tiposervico int(11) references tiposervico(id_tiposervico),
id_reserva int(11) references cadreserva(id_reserva),
dt_servico date not null,
hr_servico time not null,
tipo char(1) not null, -- Aeroporto ou Hotel
id_aeroporto int(11) references aeroporto(id_aeroporto),
nro_voo varchar(15),
dt_voo date,
hr_voo time,
observacao_voo varchar(350),
id_hotel int(11) references hotel(id_hotel),
observacao_hotel varchar(350),
valor_servico numeric(18,2),
valor_adicional numeric(18,2),
PRIMARY KEY (`id_servico`));

/* -- para Postgres


create table veiculo_categoria(
id_categoria serial not null, 
descricao varchar(50), 
ativo char(1) default null, 
data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_categoria")
);

create table cadfuncionario(
idfuncionario serial not null, 
nome varchar(200) not null,
salario varchar(10),
usuario varchar(15) not null,
senha varchar(15) not null,
dtnascimento timestamp,
data timestamp not null default now(),
ativo char(1) default 'S', 
PRIMARY KEY ("idfuncionario")
);

create table aeroporto(id_aeroporto serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_aeroporto"));

create table hotel(id_hotel serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_hotel"));

create table origem(id_origem serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_origem"));

create table tiposervico(id_tiposervico serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_tiposervico"));

create table operador(id_operador serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_operador"));

create table usuario(id_usuario serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_usuario"));

create table tipovenda(id_tipovenda serial not null, descricao varchar(100),data timestamp NOT NULL default now(), 
PRIMARY KEY ("id_tipovenda"));


create table cadreserva(id_reserva serial not null, 
nome_passageiro varchar(100),
data timestamp NOT NULL default now(), 
dt_lancamento date not null default now()::date,
hr_lancamento time not null default now()::time,
id_usuario int references usuario(id_usuario),
id_tipovenda int references tipovenda(id_tipovenda),
telefone varchar(15),
email varchar(100),
qtde_pessoas int,
qtde_adt int,
qtde_chd int,
qtde_free int,
id_operador int references operador(id_operador),
id_origem int references origem(id_origem),
valor_total numeric(18, 2),
observacao varchar(350),
PRIMARY KEY ("id_reserva"));


create table cadservico(id_servico serial not null, 
id_tiposervico int references tiposervico(id_tiposervico),
id_reserva int references cadreserva(id_reserva),
dt_servico date not null,
hr_servico time not null,
tipo char(1) not null, -- Aeroporto ou Hotel
id_aeroporto int references aeroporto(id_aeroporto),
nro_voo varchar(15),
dt_voo date,
hr_voo time,
observacao_voo varchar(350),
id_hotel int references hotel(id_hotel),
observacao_hotel varchar(350),
valor_servico numeric(18,2),
valor_adicional numeric(18,2),
PRIMARY KEY ("id_servico")); 


*/
