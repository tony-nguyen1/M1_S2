package fr.umontpellier.etu;

import java.lang.reflect.Method;

public class Main {
    public static void main(String[] args) {
        System.out.println("Hello world!");

        try {
            Class classe = Class.forName("foo.Foo");
            System.out.println(classe.getName());

            for (Method m : classe.getDeclaredMethods()) {
                System.out.println(m);
                m.setAccessible(true);
                m.invoke(classe.getDeclaredConstructor().newInstance());
            }
        } catch(Exception e) {
            System.err.println(e);
        }
    }
}