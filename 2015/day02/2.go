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
	ribbon := 0
    for sc.Scan() {
        line := sc.Text()
		s := strings.Split(line, "x")
		l, _ := strconv.Atoi(s[0])
		w, _ := strconv.Atoi(s[1])
		h, _ := strconv.Atoi(s[2])

		sm1 := min(l, w, h)
		sm2 := 0
		switch sm1 {
		case l:
			sm2 = min(w, h)
		case w:
			sm2 = min(l, h)	
		case h:
			sm2 = min(l, w)
		}
		ribbon += sm1 + sm1 + sm2 + sm2 + (l*w*h)
    }
    if err := sc.Err(); err != nil {
        log.Fatalf("scan file error: %v", err)
        return
    }
	fmt.Printf("ribbon: %d\n", ribbon)
}
