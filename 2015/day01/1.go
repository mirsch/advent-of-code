package main

import (
	"fmt"
	"strings"
	"os"
)

func main() {
	body, _ := os.ReadFile(os.Args[1])
	up := strings.Count(string(body), "(")
	down := strings.Count(string(body), ")")
	fmt.Printf("floor: %d\n", (up - down))
}
