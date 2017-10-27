import pickle
a=[1,2,3,5]

for i in a:
    print(i)
with open('man1.pickle','rb') as man_data:
    data=pickle.load(man_data)
    for line in data:
        print(line)
