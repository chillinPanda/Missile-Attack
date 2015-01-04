import sys
import platform
import time
import socket
import re
import json
import urllib2
import base64

import usb.core
import usb.util

# Define a dictionary of "command sets" that map usernames to a sequence 
# of commands to target the user (e.g their desk/workstation). 
COMMAND_SETS = {
    "test" : (
        ("zero", 0),
        ("right", 1000),
        ("zero", 0),
    ),
    "jay" : (
        ("zero", 0), # Zero/Park to know point (bottom-left)
        ("right", 1000),
        ("fire", 2), # Fire 2 missles
        ("zero", 0), # Park after use for next time
    ),
    "jill" : (
        ("zero", 0), 
        ("right", 4400),
        ("up", 200),
        ("fire", 1),
        ("zero", 0),
    ),
    "kyle" : (
        ("zero", 0), 
        ("right", 4400),
        ("up", 200),
        ("fire", 1),
        ("zero", 0),
    ),
    "mike" : (
        ("zero", 0), 
        ("right", 4400),
        ("up", 200),
        ("fire", 1),
        ("zero", 0),
    ),
    "adam" : (
        ("zero", 0), 
        ("right", 4400),
        ("up", 200),
        ("fire", 0),
        ("zero", 0),
    ),
    "john" : (
        ("zero", 0), 
        ("right", 4400),
        ("up", 200),
        ("fire", 1),
        ("zero", 0),
    ),
}

# Protocol command bytes
DOWN    = 0x01
UP      = 0x02
LEFT    = 0x04
RIGHT   = 0x08
FIRE    = 0x10
STOP    = 0x20

DEVICE = None

def setup_usb():
    global DEVICE 
    DEVICE = usb.core.find(idVendor=0x2123, idProduct=0x1010)

    if DEVICE is None:
        raise ValueError('Missile device not found')

    try:
        DEVICE.detach_kernel_driver(0)
    except Exception, e:
        pass # already unregistered    

    DEVICE.set_configuration()


def send_cmd(cmd):
    DEVICE.ctrl_transfer(0x21, 0x09, 0, 0, [0x02, cmd, 0x00,0x00,0x00,0x00,0x00,0x00])

def send_move(cmd, duration_ms):
    send_cmd(cmd)
    # send negative time to enter continouous mode. you have to send the stop command yourself!
    duration_ms = float(duration_ms)
    if duration_ms >= 0:
        time.sleep(duration_ms / 1000.0)
        send_cmd(STOP)


def run_command(command, value):
    command = command.lower()
    if command == "right":
        send_move(RIGHT, value)
    elif command == "left":
        send_move(LEFT, value)
    elif command == "up":
        send_move(UP, value)
    elif command == "down":
        send_move(DOWN, value)
    elif command == "zero" or command == "park" or command == "reset":
        # Move to bottom-left
        send_move(DOWN, 2000)
        send_move(LEFT, 8000)
    elif command == "pause" or command == "sleep":
        time.sleep(value / 1000.0)
    elif command == "fire" or command == "shoot":
        if value < 1 or value > 4:
            value = 1
        time.sleep(0.5)
        for i in range(value):
            send_cmd(FIRE)
            time.sleep(4.5)
    elif command == "stop":
        send_cmd(STOP)
    else:
        print "Error: Unknown command: '%s'" % command


def run_command_set(commands):
    for cmd, value in commands:
        run_command(cmd, value)

def main(args):

    if len(args) < 2:
        usage()
        sys.exit(1)

    setup_usb()

    # Process any passed commands or command_sets
    command = args[1]
    value = 0
    if len(args) > 2:
        value = int(args[2])

    if command in COMMAND_SETS:
        run_command_set(COMMAND_SETS[command])
    else:
        run_command(command, value)

if __name__ == '__main__':
    main(sys.argv)
