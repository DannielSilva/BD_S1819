txt = ""
for i in range(100):
    if len(str(i)) < 2:
        number = "00" + str(i)
    else:
        number = "0" + str(i)
    txt += "insert into camara values ('CAM-" + number + "');\n"
print(txt)
f1 = open("camara.sql", "w")

f1.write(txt)
f1.close()