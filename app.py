#API para obtener informacón de los elementos: películas, series y libros

from flask import Flask, jsonify
import imdb
import pprint
import json
import xmltodict
from imdb import IMDbError
import itertools
app =  Flask(__name__)

@app.route("/all")
# def show_elements():

#     # Using the Search movie method
#     #items = ia.search_movie('Avengers')
#     try:
#         # creating an instance of the IMDB()
#         cine = imdb.IMDb()
#         #i = ia.get_movie_infoset(items[0].movieID)
#         #items = cine.search_movie("", results=3)
#         #items = cine.get_top250_movies()
#         #return jsonify([item.__dict__ for item in items])
#         return items
#     except IMDbError as e:
#         return e

# home route that returns below text when root url is accessed
@app.route("/")    
def search_element():
    cine = imdb.IMDb()
    items = cine.search_movie("")
    #items_json = []
    
    # try:
       
    #     item_info = {
    #         'id' : item['id'],
    #         'title': item['title'],
    #         'year': item['year'],
    #         'kind': item['kind'],
    #         'cover_url' : item['cover_url']
    #         # Agrega otros atributos según sea necesario
    #     }
    #     items_json.append(item_info)  
    #     print(item['title'])

    
    
 
if __name__ == '__main__':  
   app.run(debug=True)