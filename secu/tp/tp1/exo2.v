(* Exercice 2 *)

Variable A : Type.
Variable P : A -> Prop.
Variable Q : A -> Prop.


(* Question 1 *)
Goal  forall x, P x -> exists y, P y \/ Q y.
    intro.
    intro.
    exists x.
    left.
    assumption.
Qed.

(* Question 2 *)
Goal (exists x, P x \/ Q x) -> (exists x, P x) \/ (exists x, Q x).
Proof.
    intro.
    destruct H.
    destruct H.
    -   left.
        exists x.
        assumption.
    -   right.
        exists x.
        assumption.
Qed.

(* Question 3 *)
Goal (forall x, P x) /\ (forall x, Q x) -> forall x, P x /\ Q x.
Proof.
    intro.
    destruct H.
    split.
    -   apply (H x).
    -   apply (H0 x).
Qed.

(* Question 4 *)
Goal (forall x, P x /\ Q x) -> (forall x, P x) /\ (forall x, Q x).
Proof.
    intro.
    split.
    -   intro.
        apply H.
    -   intro.
        apply H.
Qed.

(* Question 5 *)
Goal (forall x, ~ P x) -> ~(exists x, P x).
Proof.
    intro.
    intro.
    destruct H0.
    apply (H x).
    assumption.
Qed. (* super compliqué *)