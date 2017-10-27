def sanitize(time_string):
        if "-" in time_string:
            splitter = "-"
        elif ":" in time_string:
            splitter = ":"
        else:
            return time_string
        (mins,secs) = time_string.split(splitter)
        return mins+'.'+secs

class AthleteList(list):
    def __init__(self, name, dob=None, times=[]):
        list.__init__([])
        self.name = name
        self.dob = dob
        self.extend(times)
    def top3(self):
        return(sorted(set([sanitize(t) for t in self]))[0:3])


def get_coach_data(filename):
    try:
        with open(filename) as file_object:
            data = file_object.readline()
            tmp = data.strip().split(',')
            return AthleteList(tmp.pop(0),tmp.pop(0),tmp)
    except IOError as err:
        print("file error " +err )

James=get_coach_data('james2.txt')
print(James.top3())