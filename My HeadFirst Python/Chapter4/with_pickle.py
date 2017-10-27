import pickle

man = []
other = []

try:
    with data = open('sketch.txt'):

        for each_line in data:
            try:
                (role, line_spoken) = each_line.split(':')
                line_spoken = line_spoken.strip()
                if role == 'Man':
                    man.append(line_spoken)
                elif role == 'Other Man':
                    other.append(line_spoken)
                else:
                    pass
            except ValueError:
                pass

except IOError:
    print('The datafile is missing!')

try:
    with open('man.txt','wb') as man_data, open('other.txt','wb') as other_data:
        pickle.dump(man, man_data)
        pickle.dump(other, other_data)
except pickle.PickleError as err:
    print('File error: '+str(err))

