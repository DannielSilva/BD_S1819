#SCRIPT THAT GENERATES A SQL FILE THAT POPULATES A DATABASE WITH PSEUDO-RANDOM VALUES
#yay

#IMPORTS
from random import randrange
from random import choice
from random import randint
from datetime import timedelta
from datetime import datetime


#ARRAYS
integers_1_to_100 = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100']


#FUNCTIONS
def random_date(start, end):
    delta = end - start
    int_delta = (delta.days * 24 * 60 * 60) + delta.seconds
    random_second = randrange(int_delta)
    return start + timedelta(seconds=random_second)


def date_range(start, end, intv):
    """ splits date into #intv equal intervals, ex:
        for an intv of 3, will return array (actly it returns a generator) size 4, where intv 1 : 0-1, intv 2: 1-2 and intv
    """
    diff = (end  - start ) / intv
    for i in range(intv):
        yield (start + diff * i).strftime("%Y-%m-%d %H:%M:%S")
    yield end.strftime("%Y-%m-%d %H:%M:%S")
    

#MAIN
with open("populate.sql", 'w+') as myfile:
    #camera_table
    myfile.write("--TABELA CAMARA:\n")
    for i in range(0,100):
        myfile.write("insert into camara values (" + integers_1_to_100[i] + ");\n")
    myfile.write("\n\n")
    
    #video_table
    myfile.write("--TABELA VIDEO:\n")
    videos_array = []    
    for i in range(0,100):
        r_date_1_dt = random_date(datetime.strptime('2017-01-01 00:00',"%Y-%m-%d %H:%M"),datetime.strptime('2018-11-24 00:00',"%Y-%m-%d %H:%M"))
        r_date_2_dt = random_date(datetime.strptime('2017-01-01 00:00',"%Y-%m-%d %H:%M"),datetime.strptime('2018-11-24 00:00',"%Y-%m-%d %H:%M"))
        while (r_date_2_dt <= r_date_1_dt):
            r_date_2_dt = random_date(datetime.strptime('2017-01-01 00:00',"%Y-%m-%d %H:%M"),datetime.strptime('2018-11-24 00:00',"%Y-%m-%d %H:%M"))
        r_date_1 = str(r_date_1_dt)
        r_date_2 = str(r_date_2_dt)
        r_n_camera = choice(integers_1_to_100)
        videos_array.append([r_n_camera,r_date_1,r_date_2])
        myfile.write("insert into video values ('" + r_date_1 + "', '" + r_date_2 + "', " + r_n_camera + ");\n")
    myfile.write("\n\n")
    
    #segmento_table
    myfile.write("--TABELA SEGMENTO:\n")
    #This table will have more than 100 entries cuz each video will be divides into segments (min 2 max 5).
    for i in range(0,100):
        n_segments = randint(2,5) 
        date_start = videos_array[i][1]
        date_end = videos_array[i][2]
        n_camera = videos_array[i][0]
        intervals = list(date_range(datetime.strptime(date_start,'%Y-%m-%d %H:%M:%S'), datetime.strptime(date_end, '%Y-%m-%d %H:%M:%S'),n_segments))
        for j in range(0,n_segments):
            myfile.write("insert into segmento values('" + str(j+1) + "', '" + str((datetime.strptime(intervals[j+1],'%Y-%m-%d %H:%M:%S')-datetime.strptime(intervals[j],'%Y-%m-%d %H:%M:%S')).total_seconds())[:-2] + "', '" + str(n_camera) + "', '" + intervals[j] + "');\n")
        
    
    
        
    