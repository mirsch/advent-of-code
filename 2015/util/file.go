package file

import (
	"os"
	"bufio"
	"log"
)

func GetLinesFromFile(name string) (lines []string) {
	f, err := os.OpenFile(os.Args[1], os.O_RDONLY, os.ModePerm)
    if err != nil {
        log.Fatalf("open file error: %v", err)
        return
    }
    defer f.Close()

    sc := bufio.NewScanner(f)
    for sc.Scan() {
        lines = append(lines, sc.Text())
    }
    if err := sc.Err(); err != nil {
        log.Fatalf("scan file error: %v", err)
        return
    }

	return
}
