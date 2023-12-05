package main

import (
	"fmt"
	"os"
	"github.com/mirsch/advent-of-code/util"
)

func main() {
	lines := file.GetLinesFromFile(os.Args[1])
	houses := map[int]map[int]int{0: map[int]int {0: 1}}
	uniqueHouses := 1
	x := 0
	y := 0
	for _, line := range lines {
		for _, char := range line {
			switch string(char) {
			case ">":
				x++
			case "<":
				x--
			case "^":
				y--
			case "v":
				y++
			}

			visitedCount, visited := houses[x][y]
			fmt.Println(x, y, visited, visitedCount)
			if ! visited || visitedCount == 0 {
				_, xx := houses[x]
				if ! xx {
					houses[x] = map[int]int{0: 0}
				}
				houses[x][y]++
				uniqueHouses++
				continue
			}

			houses[x][y]++
		}
	}
	
	fmt.Printf("houses: %d\n", uniqueHouses)
}

