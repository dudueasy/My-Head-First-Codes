def sanitize(time_string):
        if "-" in time_string:
            splitter = "-"
        elif ":" in time_string:
            splitter = ":"
        else:
            return time_string
        (mins,secs) = time_string.split(splitter)
        return mins+'.'+secs


def get_coach_data(filename):
    try:
        with open(filename) as file_data:
            data = file_data.readline()
            temp = data.strip().split(',')
            '''return dict['Name'] dict['DOB'] and sorted-full-elements-dict['Times'] '''

            return ({'Name':temp.pop(0), 'DOB':temp.pop(0),
            'Times':str(sorted(set([sanitize(t) for t in temp]))[0:3])
            })
            
    except IOError as err:
        print('File error: '+ str(err))
        return None

sarah = get_coach_data('sarah2.txt')
print(sarah['Name'] + "'s fastest times are: " + sarah['Times'])

james = get_coach_data('james2.txt')
print(sarah['Name'] + "'s fastest times are: " + sarah['Times'])

