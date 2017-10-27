import apolo_nester
'''this file use apolo_nester.print_lol() to read sketch.txt file, split the text, 
store it in other files '''

man = []
other = []

try:
    data = open('sketch.txt')

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

    data.close()
except IOError:
    print('The datafile is missing!')

try:
    with open('man.txt','w') as man_file, open('other.txt','w') as other_file:
        apolo_nester.print_lol(man,file_object=man_file)
        apolo_nester.print_lol(other,file_object=other_file)
except IOError as err:
    print('File error: '+str(err))

