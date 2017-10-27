def sanitize(time_string):
        if "-" in time_string:
            splitter = "-"
        elif ":" in time_string:
            splitter = ":"
        else:
            return time_string
        (mins,secs) = time_string.split(splitter)
        return mins+'.'+secs

class Athlete:
    def __init__(self, name, dob=None, times=[]):
        self.name = name
        self.dob = dob
        self.times = times
    def top3(self):
        return(sorted(set([sanitize(t) for t in self.times]))[0:3])

def get_coach_data(filename):
    try:
        with open(filename) as file_data:
            data = file_data.readline()
            temp = data.strip().split(',')
            '''return a instance of class Athlete '''
            return Athlete(temp.pop(0),temp.pop(0),temp)

    except IOError as err:
        print('File error: '+ str(err))
        return None

james = get_coach_data('james2.txt')
julie = get_coach_data('julie2.txt')
sarah = get_coach_data('sarah.txt')
mikey = get_coach_data('mikey.txt')
print(james.name + "'s fastest times are: " + str(james.top3()))
print(julie.name + "'s fastest times are: " + str(julie.top3()))