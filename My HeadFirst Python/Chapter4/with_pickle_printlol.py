import pickle
import apolo_nester

man=[]
other=[]

try:
    with open('sketch.txt') as data:
        for line in data:
            try:
                (role, spoken)=line.split(":",1)
                spoken=spoken.strip()
                if role=="Man":
                    man.append(spoken)
                elif role=="Other Man":
                    other.append(spoken)
            except:
                pass
except IOError as err:
    print("File error "+str(err))

try:
    with open('man1.txt','wb') as man_data, open('other1.txt','wb') as other_data:
        pickle.dump(man,man_data)
        pickle.dump(other,other_data)

except IOError as err:
    print('File error: '+str(err))
except pickle.PickleError as perr:
    print('Pickle error: '+str(perr))

try:
    with open('man1.txt','rb') as man_file, open('new_man.txt','w') as new_man_data:
        new_man = pickle.load(man_file)
        apolo_nester.print_lol(new_man,file_object=new_man_data)
except IOError as err:
    print('File error: '+str(err))
except pickle.PickleError as perr:
    print('Pickle error: '+str(perr))
