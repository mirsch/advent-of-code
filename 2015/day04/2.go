package main

import (
	"fmt"
	"os"
	"github.com/mirsch/advent-of-code/util"
	"crypto/md5"
	"encoding/hex"
	"regexp"
	"strconv"
)


func getMD5Hash(text string) string {
   hash := md5.Sum([]byte(text))
   return hex.EncodeToString(hash[:])
}

func main() {
	lines := file.GetLinesFromFile(os.Args[1])
	secret := lines[0]
	i := 0
	for {
		i++
		v := secret + strconv.Itoa(i)
		h := getMD5Hash(v)
		found, _ := regexp.MatchString(`^0{6}[^0]`, h)
		if found {
			fmt.Printf("value: %s\n", v)
			fmt.Printf("hash: %s\n", h)
			fmt.Printf("iteration: %d\n", i)
			break
		}
	}
}

