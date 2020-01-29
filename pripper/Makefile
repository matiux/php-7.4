 # Go parameters
GOCMD=go
GOBUILD=$(GOCMD) build
GOCLEAN=$(GOCMD) clean
GOLIB=go_pripper.so

# C parameters
CCMD=gcc
CLIB=c_pripper.o

all: build_go build_c

build_go:
	$(GOBUILD) -o $(GOLIB) -buildmode=c-shared go_pripper.go
	cp go_pripper.header go_pripper.h

build_c:
	$(CCMD) -c -g c_pripper.c
	$(CCMD) -c -g main.c
	$(CCMD) -o pripper main.o $(CLIB) ./$(GOLIB)
	$(CCMD) -shared -o c_pripper.so $(CLIB)

.PHONY: clean
clean:
	-rm -f *.o $(objects)
	-rm -f *.a $(objects)
	-rm -f *.so $(objects)
	-rm -f pripper $(objects)
	#-rm -f go_pripper.header $(objects)
	-rm -f core $(objects)
