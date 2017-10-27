import os
man=[]
other=[]
try:
    data=open('sketch.txt')
    for each in data:
        try:
            (role, line_spoken)=each.split(':',1)
            line_spoken=line_spoken.strip();
            if role=='Man':
                man.append(line_spoken)

            if role=='Other Man':
                other.append(line_spoken)
        except ValueError:
            pass
except IOError:
    print('the data file is missing!')

print(man)
print(other)

        