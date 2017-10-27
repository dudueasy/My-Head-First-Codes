
count = 0

def verify_username(file_object,count):
    if count<3:
        #print(count)
        username = input('Please input username: ')
        for line in file_object:
            info_list = line.split(":")
            #print(line)
            if username == info_list[1].strip():
                auth_passwd = info_list[-1].strip()
                verify_passwd(file_object,auth_passwd,count,username)
                break
        else:
            verify_username(file_object,count+1)
    else:
        print('user locked')

def verify_passwd(file_object,auth_passwd,count,username):
    if count<3:
        #print(count)
        passwd = input("Please input your password: ") 
        #print(auth_passwd)
        if passwd == auth_passwd:
            print('welcome back ' + username)
        else:
            verify_passwd(file_object,auth_passwd,count+1,username)
    else:
        print('user locked')

with open('userinfo.txt') as userinfo:
       verify_username(userinfo, count)
 
