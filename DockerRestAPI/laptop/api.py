# Laptop Service

from flask import Flask, request
from flask_restful import Resource, Api
from pymongo import MongoClient
import os
# Instantiate the app
app = Flask(__name__)
api = Api(app)

client = MongoClient("db", 27017)
db = client.tododb

def top_k():
    top = request.args.get("top")
    if top:
        item = db.tododb.find().limit(int(top))
    else:
        item = db.tododb.find()
    return item


def find_and_append(item, item_list):
    dictionary = {}
    for key in item_list:
        dictionary[key] = []
    for i in item:
        for key in item_list:
            dictionary[key].append(i[key])
    return dictionary

def find_and_add(item,item_list):
    csv = ""
    for key in item_list:
        csv += key + " "
    csv += ": "
    for i in item:
        for key in item_list:
            csv += key + ": " + i[key] + " "
        csv += "|| "
    return csv

class Laptop(Resource):
    def get(self):
        return {
            'Laptops': ['Mac OS', 'Dell',
            'Windozzee',
	    'Yet another laptop!',
	    'Yet yet another laptop!'
            ]
        }

class listAll(Resource):
    def get(self):
        item = top_k()
        item_list = ["open", "close"]
        open_close = find_and_append(item, item_list)
        return open_close

class listAllCsv(Resource):
    def get(self):
        item_list = ["open", "close"]
        item = top_k()
        all_csv = find_and_add(item, item_list)
        return all_csv


class listOpenOnly(Resource):
    def get(self):
        item_list = ["open"]
        item = top_k()
        open = find_and_append(item, item_list)
        return open

class listOpenOnlyCsv(Resource):
    def get(self):
        item_list = ["open"]
        item = top_k()
        open_csv = find_and_add(item, item_list)
        return open_csv


class listCloseOnly(Resource):
    def get(self):
        item_list = ["close"]
        item = top_k()
        close = find_and_append(item, item_list)
        return close

class listCloseOnlyCsv(Resource):
    def get(self):
        item_list = ["close"]
        item = top_k()
        close_csv = find_and_add(item, item_list)
        return close_csv


# Create routes
# Another way, without decorators
api.add_resource(Laptop, '/')
api.add_resource(listAll, '/listAll', '/listAll/json')
api.add_resource(listOpenOnly, '/listOpenOnly', '/listOpenOnly/json')
api.add_resource(listCloseOnly, '/listCloseOnly', '/listCloseOnly/json')

api.add_resource(listAllCsv, '/listAll/csv')
api.add_resource(listOpenOnlyCsv, '/listOpenOnly/csv')
api.add_resource(listCloseOnlyCsv, '/listCloseOnly/csv')
# Run the application
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
