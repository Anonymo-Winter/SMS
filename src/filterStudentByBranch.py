# the entered file should be a mid shuffle csv with removed ,,(double comma)

import os
print("*** Select One Of The Following :***");
print("\t 1.CSE\n\t2.ECE\n\t3.EEE\n\t4.MECH")
print("*** Enter Your Choice >")
n= int(input())
filename = "all_students"
dept = ""
if(n==1):
    dept = "CSE"
    filename += "\CSE_STUDENTS.csv"
elif(n==2):
    dept = "ECE"
    filename = "\ECE_STUDENTS.csv"
elif(n==3):
    dept = "EEE"
    filename = "\EEE_STUDENTS.csv"
else:
    print("Invalid option")
    exit()
with open('all_students/all_students.csv','r') as f:
    f2 = open(filename,"w")
    w=[]
    for i in f:
        x=i.split(',')
        if(x[3].startswith(dept)):
            w.extend([x[1].upper()+","+x[2].upper()+","+x[3].upper()+"\n"])
    w.sort()
    for i in w:
        f2.writelines(w)
    f.close()
    f2.close()
