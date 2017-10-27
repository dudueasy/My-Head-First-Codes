def get_coach_data(filename):
    try:
        with open(filename) as file_data:
            data = file_data.readline()
            return data.strip().split(',')
    except IOError as err:
        print('File error: '+ str(err))
        return None


def sanitize(time_string):
        if "-" in time_string:
            splitter = "-"
        elif ":" in time_string:
            splitter = ":"
        else:
            return time_string
        (mins,secs) = time_string.split(splitter)
        return mins+'.'+secs

sarah = get_coach_data('sarah2.txt')
(sarah_name, sarah_dob) = sarah.pop(0), sarah.pop(0)

print(sarah_name + "'s fastest times are: " + str(sorted(set([sanitize(t) for t in sarah]))[0:3]))