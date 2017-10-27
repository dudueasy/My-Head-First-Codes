def open_formate_sort(filename, formatted_list=[]):
        with open(filename) as file_object:
                '''read, strip and split file_object into new list''' 
                a_list = file_object.readline().strip().split(',')
        '''sanitize a_list, assign sanitized list to formatted_list'''        
        for elements in a_list:
                if '-' in elements:
                        splitter = '-'
                elif ':' in elements:
                        splitter = ':'
                else:
                        splitter = '.'
                (mins,secs) = elements.split(splitter)
                formatted_list.append(mins+'.'+secs)
        '''print sorted formatted_list'''
        print(sorted(formatted_list))
        
