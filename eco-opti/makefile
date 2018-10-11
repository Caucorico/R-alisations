executable: main.o data.o calc.o gest_struct.o
	gcc -o executable main.o data.o calc.o gest_struct.o

data.o: data.c data.h
	gcc -o data.o -c data.c -W -Wall -ansi -pedantic

gest_struct.o: gest_struct.c data.h gest_struct.h
	gcc -o gest_struct.o -c gest_struct.c -W -Wall -ansi -pedantic

calc.o: calc.c data.h gest_struct.h calc.h
	gcc -o calc.o -c calc.c -W -Wall -ansi -pedantic

main.o: main.c data.h calc.h gest_struct.h
	gcc -o main.o -c main.c -W -Wall -ansi -pedantic

clean:
	rm -rf Binary/*.o