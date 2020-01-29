package main

// #include <stdlib.h>
import "C"

import (
	"fmt"
	"strings"
	"unsafe"
)

//export GoPripper
func GoPripper(string *C.char) *C.char {

	gostr := C.GoString(string)

	gostrUpper := strings.ToUpper(gostr)

	cstr := C.CString(gostrUpper)
	//defer C.free(unsafe.Pointer(cstr))

	return cstr
}

func main() {

	cstr := C.CString("ciao")
	defer C.free(unsafe.Pointer(cstr))

	goString := C.GoString(GoPripper(cstr))

	fmt.Printf("%s\n",goString)
}

/**
http://snowsyn.net/2016/09/11/creating-shared-libraries-in-go/
https://medium.com/@walkert/fun-building-shared-libraries-in-go-639500a6a669

1) go build -o go_pripper.so -buildmode=c-shared go_pripper.go
*/
