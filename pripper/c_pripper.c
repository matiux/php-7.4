#include "c_pripper.h"
#include "go_pripper.h"

/*
https://medium.com/learning-the-go-programming-language/calling-go-functions-from-other-languages-4c7d8bcc69bf
https://computer.howstuffworks.com/c15.htm
*/


char* CPripper(char *buffer)
{
    return GoPripper(buffer);
}