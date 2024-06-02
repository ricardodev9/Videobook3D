#API para obtener informacón de los elementos: películas, series y libros
import flask
from flask import Flask, request, jsonify
import requests
import imdb
import json
import xmltodict
from imdb import IMDbError
import itertools
from flask_cors import CORS
from inspect import getmembers
from pprint import pprint

app =  Flask(__name__)
CORS(app)  # Habilitar CORS para todos los endpoints
# home route that returns below text when root url is accessed

# def search_element(id):
#     cine = imdb.IMDb()
#     # items = cine.get_movie(id)
#     res = []
#     for i in id:
#         items = cine.get_movie(i)
#         res.append({i : items})
#     return res

# @app.route("/", methods=['GET','POST'])    
# def show_element():
#     try:
#         id_imdb = request.form.getlist('ids_imdb[]')
#         results = []
#         movies = search_element(id_imdb)
#         for movie in movies:  
#             # Iteramos sobre cada elemento en la lista de diccionarios
#             for id, info in movie.items():
#                 results.append({
#                     'ID': id,  # Utilizamos el ID del diccionario como ID del resultado
#                     'Título': info.get('title'),
#                     'Año': info.get('year'),
#                     'Tipo': info.get('kind')
#                 })
            
#         return jsonify({"type":"ok","msg":results})
#     except requests.RequestException as e:
#         # Manejar cualquier error de solicitud
#         return jsonify({
#             "success": False,
#             "message": f"Error al realizar la solicitud a la API de OpenWeatherMap: {str(e)}"
#         })           
def search_element(id):
    cine = imdb.IMDb()
    # items = cine.get_movie(id)
    try:
        items = cine.get_movie(id)
    except IMDbError as e:
        items = []
    return items

#método para obtener la compaía de la película
#error: no recupera el nombre, es null siempre
def get_company_by_movieID(id_imdb):
    cine = imdb.IMDb()
    try:
        comp_data = cine.get_company(id_imdb)
        company = {
            'name': comp_data.get('name','N/A'),
            'id': comp_data.getID()
        }
    except IMDbError as e:
        company = {}
    return company

#recogemos la información del método search_element
#guardamos el cast en un array 
#guardamos los géneros en un array
#guardmamos la compañía en un array
#guardamos todo en un array
@app.route("/buscar", methods=['GET','POST'])    
def show_element():
    ia = imdb.IMDb()
    id_imdb = request.form.get('id_imdb')
    cine = ia.get_movie(id_imdb)
    result = {
        'cast': [],
        'genres': [],
        'rating': None,
        'producers': [],
        'companies': []
    }

    if 'cast' in cine:
        result['cast'] = [{"id": per.personID, "name": per['name']} for per in cine['cast']]
    
    if 'genres' in cine:
        result['genres'] = cine['genres']
    
    if 'rating' in cine:
        result['rating'] = {"rating": cine['rating']}
    
    if 'producer' in cine:
        result['producers'] = [{"id": prod.personID, "name": prod['name']} for prod in cine['producer']]
    
    if 'production companies' in cine:
        result['companies'] = [{"id": comp.companyID, "name": comp['name']} for comp in cine['production companies']]
    
    return jsonify(result)

    # ia = imdb.IMDb()
    # companies = ia.get_company('0017902')
    # pprint(getmembers(ia.get_company_infoset()))
    # return jsonify({"type" : "ok" , "msg" : "123"})

#buscar persona:
# person = ia.get_person('0000206')
# person['name']
# 'Keanu Reeves'
# person['birth date']
# '1964-9-2'
# company = ia.get_company('0017902')
# company['name']
# 'Pixar Animation Studios'


# actor = movie['cast'][6]
# actor
# actor.notes
# '(as Warren Kemmerling)'



# julia = i.get_person('0000210')
# for job in julia['filmography'].keys():
#     print('# Job: ', job)
#     for movie in julia['filmography'][job]:
#         print('\t%s %s (role: %s)' % (movie.movieID, movie['title'], movie.currentRole))
if __name__ == '__main__':  
   app.run(debug=True)