import random ,re

def conventer_to_list(word):
    def emptyns_remover(x):
        return x !=''
    rand_list = word.split(" ")
    return list(filter(emptyns_remover,rand_list))

def the_mixer(pw,num):
    cont=0
    new_pass=''
    for i in pw:
        for n in num:
            rand = random.randint(0,9)
            if rand > 5 and cont < len(num):
                new_pass=new_pass+num[cont]
                cont=cont+1
            break
        new_pass=new_pass+i    
    return new_pass


sentens = input("Enter at lest 8 words: ")

sent_list = conventer_to_list(sentens)

while len(sent_list) < 8: 
    sentens= input("ERROR :: LESS THAN 8 WORDS :: \nPLEZ RENTER 8 WORDS AT LEST : ")
    sent_list = conventer_to_list(sentens)

password=''
for letter in sent_list:
        password = password+letter[0]

numper=input("Enter 2 or 3 deget numper u can't forget: ")

new_password = the_mixer(password,numper)

print(len(password))
print(password)

print(len(new_password))
print(new_password)
