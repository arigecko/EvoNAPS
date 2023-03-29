#! /usr/bin/env python3

'''
Python script to print the random seed number from the *.iqtree output file generated by IQ-Tree2 
after running the EvoNAPS workflow on an alignment. 

Created: August 2022
Last updated: 13.03.2022
Author: Franziska Reden
'''

import pandas as pd 
import sys

def main(): 
    '''
    This script is part of the EvoNAPS workflow to gather natrual parameter settings of evolutionary models.
    Aim of this script is to print the random seed number used by IQ-Tree 2 by parsing through the *.iqtree 
    output file. The seed number will then be used in a second IQ-Tree 2 run (with --kee-ident flag).

    USAGE: 
    -------
    >>> get_seed.py [--file FILE_NAME.iqtree] 

    OPTIONS: 
    -------
    --file   
        Mandatory argument. Declares the path to and name of of the *iqtree file. 
        Typically, the prefix will be the name of the alignment file that has been used as input for IQ-Tree 2.
    --help or -h
        Print information regarding script for help.

    OUTPUT: 
    -------
    The script returns the random seed number by printing it onto the terminal.

    EXAMPLE: 
    -------
    >>> get_seed.py --file file_name.iqtree
    >>> 124376
    """
    '''

    file_name = None
    
    for i in range (len(sys.argv)): 
        if sys.argv[i] == '--file': 
            file_name = sys.argv[i+1]
        if sys.argv[i] == '--help' or sys.argv[i] == '-h': 
            print(main.__doc__)

    if file_name is None: 
        print('WARNING: Missing input file. Declare input file with --file poption.')
        sys.exit(2)

    with open (file_name) as t: 
        data = t.readlines()

    for i in range (len(data)): 
        if data[i][:len('Random seed number: ')] == 'Random seed number: ': 
            seed_num = str(data[i][len('Random seed number: '):-1])
            break 
        
    print(seed_num)

if __name__ == '__main__': 
    main()