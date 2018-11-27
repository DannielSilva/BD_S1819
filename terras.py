# coding=utf-8
from random import randrange
from random import choice
from random import randint
from datetime import timedelta
from datetime import datetime
def remove_n(string):
    return string[:-1]

f1 = open("terras_ascii.txt","r")
#CRIACAO DE TERRINHAS
terras = f1.readlines()
terras = list(set(terras))
terras = list(filter(lambda x: x != "\n", terras))
terras = list(map(remove_n, terras))
#print(terras)
#print(len(terras))
f1.close()

#CRIACAO DE NOMES
nomes = ["Ana", "Catarina", "Helena", "Rita", "Ines", "Joao", "Daniel", "Diogo", "Tiago", "Miguel"]
apelidos = ["Ferreira", "Silva", "Marante", "Mesquita", "Barata", "Dias", "Mota", "Santos", "Baltazar", "Oliveira"]
nomes_final = []
txt = ""
for i in range(len(nomes)):
    for j in range(len(apelidos)):
        nomes_final.append(nomes[i] + " " + apelidos[j])

#CRIACAO DE NUMS DE TELEFONE
numero = 920000000
numeros = []
for i in range(100):
    numeros.append(numero + i)
#print(numeros)
#print(len(numeros))

#FUNCTIONS
def random_date(start, end):
    delta = end - start
    int_delta = (delta.days * 24 * 60 * 60) + delta.seconds
    random_second = randrange(int_delta)
    return start + timedelta(seconds=random_second)


#VIGIA
used = []
uniques  = []
txt = ""
for i in range(len(terras)):
    simNao = randint(0,1)
    if simNao == 1 :
        num = randint(0,len(terras))
        while num in used:
            num=randint(0,len(terras))
        used.append(num)
        txt += "insert into vigia values ('" + terras[i] + "', " + str(num) + ");\n"

#EVENTOEMERGENCIA
#pode se repetir o nome da pessoa? choice(nomes)
txt+= "\n"
for i in range(100):
    txt += "insert into eventoEmergencia  values (" + str(numeros[i])+ ", '" + str(random_date(datetime.strptime('2017-01-01 00:00',"%Y-%m-%d %H:%M"),datetime.strptime('2018-11-24 00:00',"%Y-%m-%d %H:%M"))) + "', '" + choice(nomes_final) + "', '" + terras[i] + "', " + str(i) + ");\n"

#processoSocorro
txt+= "\n"
for i in range(100):
    txt += "insert into processoSocorro values (" + str(i) + ");\n"

#LOCAL
txt+= "\n"
for i in range(0,len(terras)):    
    txt += "insert into local values ('" + terras[i] + "');\n"

#ENTIDADE MEIO
#500 entidades?

txt+= "\n"
ents_terrinhas = ["Bombeiros de", "Policia Municipal de"]
ents_nacional = ["Exercito", "Força Aerea", "PSP", "GNR"]

ents_final = []

for terra in terras:
    for ent in ents_terrinhas:
        entidade = ent + " " + terra
        ents_final.append(entidade)
        txt += "insert into entidadeMeio values ('" + entidade + "');\n"
for ent in ents_nacional:
    ents_final.append(ent)
    txt += "insert into entidadeMeio values ('" + ent + "');\n"

#MEIO
#poucos meios?
txt+= "\n"
used = []
for i in range(100):
    num = randint(0,100)
    #nome = ?
    ent = choice(ents_final)
    while [num, ent] in used:
        num = randint(0,100)
        ent = choice(ents_final)
    used.append([num, ent])
    #falta o nome
    txt += "insert into meio values (" + str(num) + ", '" + ent + "');\n" 


f1 = open("terras.sql", "w")

f1.write(txt)
f1.close()

['Oliveira do Hospital', 'Albergaria-a-Velha', 'Proenca-a-Nova', 'Valpacos', 'Aljustrel', 'Sao Pedro do Sul', 'Castro Daire', 'Batalha', 'Torres Vedras', 'Sesimbra', 'Tondela', 'Vila Verde', 'Amares', 'Ferreira do Alentejo', 'Penacova', 'Salvaterra de Magos', 'Santarem', 'Alenquer', 'Caldas da Rainha', 'Vila Real', 'Boticas', 'Vila Flor', 'Velas', 'Sardoal', 'Castanheira de Pera', 'Celorico de Basto', 'Belmonte', 'Almada', 'Lourinha', 'Vila do Porto', 'Mira', 'Povoa de Varzim', 'Moura', 'Vila Nova de Famalicao', 'Nisa', 'Gondomar', 'Viana do Castelo', 'Felgueiras', 'Guarda', 'Odivelas', 'Odemira', 'Fafe', 'Ourique', 'Penela', 'Vila Nova de Cerveira', 'Vila Franca do Campo', 'Agueda', 'Marco de Canaveses', 'Arouca', 'Penedono', 'Vila Nova de Paiva', 'Trancoso', 'Sever do Vouga', 'Loures', 'Cantanhede', 'Viana do Alentejo', 'Aljezur', 'Vila Nova de Poiares', 'Evora', 'Alpiarca', 'Marvao', 'Lousada', 'Crato', 'Campo Maior', 'Vinhais', 'Caminha', 'Moita', 'Penafiel', 'Amarante', 'Nelas', 'Alandroal', 'Penalva do Castelo', 'Alijo', 'Cabeceiras de Basto', 'Montemor-o-Velho', 'Cartaxo', 'Aveiro', 'Vila Real de Santo Antonio', 'Espinho', 'Barrancos', 'Coruche', 'Santa Cruz das Flores', 'Moncao', 'Tarouca', 'Mondim de Basto', 'Santa Marta de Penaguiao', 'Pampilhosa da Serra', 'Lagoa', 'Santa Cruz', 'Terras de Bouro', 'Sernancelhe', 'Cuba', 'Alfandega da Fe', 'Ovar', 'Palmela', 'Sobral de Monte Agraco', 'Golega', 'Vieira do Minho', 'Ansiao', 'Beja', 'Arruda dos Vinhos', 'Serpa', 'Vila Nova de Foz Coa', 'Bombarral', 'Maia', 'Alcochete', 'Praia da Vitoria', 'Sabrosa', 'Matosinhos', 'Cascais', 'Mafra', 'Figueira de Castelo Rodrigo', 'Monchique', 'Paredes', 'Coimbra', 'Arcos de Valdevez', 'Ribeira de Pena', 'Serta', 'Calheta', 'Oliveira de Azemeis', 'Miranda do Corvo', 'Vila Velha de Rodao', 'Arganil', 'Sabugal', 'Santa Comba Dao', 'Arraiolos', 'Murtosa', 'Guimaraes', 'Vale de Cambra', 'Montalegre', 'Condeixa-a-Nova', 'Vila do Bispo', 'Ourem', 'Loule', 'Braganca', 'Ponte da Barca', 'Constancia', 'Avis', 'Montemor-o-Novo', 'Grandola', 'Abrantes', 'Fronteira', 'Castelo de Paiva', 'Sao Joao da Pesqueira', 'Almeirim', 'Machico', 'Fornos de Algodres', 'Seia', 'Povoacao', 'Marinha Grande', 'Vila Nova de Gaia', 'Figueira da Foz', 'Alcobaca', 'Oliveira de Frades', 'Alter do Chao', 'Freixo de Espada a Cinta', 'Pedrogao Grande', 'Tavira', 'Vimioso', 'Baiao', 'Corvo', 'Rio Maior', 'Mourao', 'Monforte', 'Fundao', 'Sao Bras de Alportel', 'Chaves', 'Azambuja', 'Santa Cruz da Graciosa', 'Porto de Mos', 'Vizela', 'Ponta do Sol', 'Ilhavo', 'Vidigueira', 'Povoa de Lanhoso', 'Gois', 'Carregal do Sal', 'Angra do Heroismo', 'Sao Vicente', 'Madalena', 'Carrazeda de Ansiaes', 'Oeiras', 'Porto Moniz', 'Vila Franca de Xira', 'Torres Novas', 'Sintra', 'Castelo Branco', 'Valongo', 'Anadia', 'Leiria', 'Sousel', 'Camara de Lobos', 'Santiago do Cacem', 'Cadaval', 'Figueiro dos Vinhos', 'Lousa', 'Satao', 'Almeida', 'Soure', 'Castro Marim', 'Lagos', 'Aguiar da Beira', 'Santo Tirso', 'Mortagua', 'Lisboa', 'Vila Nova da Barquinha', 'Chamusca', 'Alcacer do Sal', 'Covilha', 'Viseu', 'Vila Pouca de Aguiar', 'Ribeira Grande', 'Mertola', 'Almodovar', 'Barreiro', 'Ponta Delgada', 'Arronches', 'Mora', 'Seixal', 'Pombal', 'Esposende', 'Manteigas', 'Alvito', 'Castro Verde', 'Portel', 'Oleiros', 'Lajes das Flores', 'Silves', 'Cinfaes', 'Vouzela', 'Macao', 'Resende', 'Redondo', 'Alcanena', 'Alcoutim', 'Lajes do Pico', 'Vila de Rei', 'Penamacor', 'Nordeste', 'Mogadouro', 'Oliveira do Bairro', 'Estarreja', 'Mealhada', 'Tabuaco', 'Celorico da Beira', 'Pacos de Ferreira', 'Trofa', 'Nazare', 'Sao Roque do Pico', 'Olhao', 'Murca', 'Mesao Frio', 'Castelo de Vide', 'Torre de Moncorvo', 'Tabua', 'Mirandela', 'Meda', 'Peniche', 'Lamego', 'Santa Maria da Feira', 'Armamar', 'Ponte de Lima', 'Paredes de Coura', 'Gouveia', 'Miranda do Douro', 'Moimenta da Beira', 'Ferreira do Zezere', 'Portimao', 'Obidos', 'Ribeira Brava', 'Idanha-a-Nova', 'Gaviao', 'Vagos', 'Benavente', 'Alvaiazere', 'Melgaco', 'Vila Vicosa']
