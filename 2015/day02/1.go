package main

import (
	"fmt"
	"strings"
	"os"
	"strconv"
	"bufio"
	"log"
)

func main() {
	f, err := os.OpenFile(os.Args[1], os.O_RDONLY, os.ModePerm)
    if err != nil {
        log.Fatalf("open file error: %v", err)
        return
    }
    defer f.Close()

    sc := bufio.NewScanner(f)
	sqare_feet := 0
    for sc.Scan() {
        line := sc.Text()
		s := strings.Split(line, "x")
		l, _ := strconv.Atoi(s[0])
		w, _ := strconv.Atoi(s[1])
		h, _ := strconv.Atoi(s[2])

		s1 := l*w
		s2 := w*h
		s3 := h*l
		sqare_feet += 2*s1 + 2*s2 + 2*s3 + min(s1, s2, s3)
    }
    if err := sc.Err(); err != nil {
        log.Fatalf("scan file error: %v", err)
        return
    }
	fmt.Printf("square feet: %d\n", sqare_feet)
}
