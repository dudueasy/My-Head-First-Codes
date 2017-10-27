with open('james.txt') as jaf:
        data = jaf.readline()
        james = data.strip().split(',')
with open('julie.txt') as juf:
        data = juf.readline()
        julie = data.strip().split(',')

with open('mikey.txt') as mif:
        data = mif.readline()
        mikey = data.strip().split(',')

with open('sarah.txt') as saf:
        data = saf.readline()
        sarah = data.strip().split(',')

def sanitize(time_string):
        global splitter
        if '-' in time_string:
                splitter = '-'
        elif ':' in time_string:
                splitter = ':'
        else:
                return time_string
        (mins,secs) = time_string.split(splitter)
        
        return (mins + "." + secs)

james = [sanitize(each_t) for each_t in james]
julie = [sanitize(each_t) for each_t in julie]
sarah = [sanitize(each_t) for each_t in sarah]
mikey = [sanitize(each_t) for each_t in mikey]




print(sorted(set(james))[0:3])
print(sorted(set(julie))[0:3])
print(sorted(set(sarah))[0:3])
print(sorted(set(mikey))[0:3])