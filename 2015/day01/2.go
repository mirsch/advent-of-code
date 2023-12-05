package main

import (
	"fmt"
	//"strings"
	"os"
)

func main() {
	body, _ := os.ReadFile(os.Args[1])
	floor := 0
	for i := 0; i < len(body); i++ {
		if string(body[i]) == "(" {
			floor++
		}
		if string(body[i]) == ")" {
			floor--
		}

		if floor == -1 {
			fmt.Printf("floor -1 at: %d\n", i + 1)
			os.Exit(0)
		}
	}
	fmt.Printf("wrong turn\n")
}
