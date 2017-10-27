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

formatted_james=[]
formatted_julie=[]
formatted_mikey=[]
formatted_sarah=[]


'''function to format elements in lists'''
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

def format_append(a_list, formatted_list):
        try: 
                for element in a_list:
                        formatted_list.append(sanitize(element))

        except ValueError as verr:
                print('Value error: '+ str(verr))
        
'''start formatting list'''
format_append(james,formatted_james)
format_append(julie,formatted_julie)
format_append(mikey,formatted_mikey)
format_append(sarah,formatted_sarah)

print(sorted(formatted_james))
print(sorted(formatted_julie))
print(sorted(formatted_mikey))
print(sorted(formatted_sarah))

