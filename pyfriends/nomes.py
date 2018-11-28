
nomes = ["Ana", "Catarina", "Helena", "Rita", "Ines", "Joao", "Daniel", "Diogo", "Tiago", "Miguel"]
apelidos = ["Ferreira", "Silva", "Marante", "Mesquita", "Barata", "Dias", "Mota", "Santos", "Baltazar", "Oliveira"]
nomes_final = []
txt = ""
for i in range(len(nomes)):
    for j in range(len(apelidos)):
        nomes_final.append(nomes[i] + " " + apelidos[j])
print(nomes_final)
print(len(nomes_final))
#f1 = open("camara.sql", "w")

#f1.write(txt)
#f1.close()