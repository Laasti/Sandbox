# Laasti
A PHP Framework based on PHP League and Symfony components. Laasti is finnish for Mortar. 

Laasti aims to make full use of composer packages to built a development-ready framework.

Laasti is inspired by MVC, DDD, and ADR

Features:
A stack of middlewares
A routing to class (Action), not method (TODO)
Controllers just send data to the responder and don't instantiate a view
Response deals with view related stuff
Have a way to compose a view, call a class/service when a view is requested
Fully testable