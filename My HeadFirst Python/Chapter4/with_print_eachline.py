man = []
other = []

try:
    data = open('sketch.txt')

    for each_line in data:
        try:
            (role, line_spoken) = each_line.split(':')
            line_spoken = line_spoken.strip()
            if role == 'Man':
                try: 
                    with open('man.txt','a') as man_file:
                        print(line_spoken,file = man_file)
                except IOError as err:
                    print('File error: ' +str(err))

            elif role == 'Other Man':
                try: 
                    with open('other.txt','a') as other_file:
                         print(line_spoken,file = other_file)
                except IOError as err:
                    print('File error: ' +str(err))
            else:
                pass
        except ValueError:
            pass

    data.close()
except IOError:
    print('The datafile is missing!')

