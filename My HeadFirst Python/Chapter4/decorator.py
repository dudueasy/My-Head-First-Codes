def decone(fn):
    def wrapped():
        return "one "+fn()
    return wrapped

def dectwo(fn):
    def wrapped():
        return "two "+fn()
    return wrapped

@decone
@dectwo
def hello():
    return "hello world"
def hello1():
    return "hello world1 test"
def hello2():
   return 'hello world2'

print(hello())
