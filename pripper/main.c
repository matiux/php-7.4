#include <stdio.h>
#include <stdlib.h>
#include "c_pripper.h"

/*
2) gcc -c -g c_pripper.c
3) gcc -c -g main.c
4) gcc -o pripper main.o c_pripper.o ./go_pripper.so
5) gcc -shared -o c_pripper.so c_pripper.o
*/
 


int main()
{
    char    *buffer;
    size_t  n = 1024;
    buffer = malloc(n);
    getline(&buffer, &n, stdin);

    printf(">> output >> %s", CPripper(buffer));
}
